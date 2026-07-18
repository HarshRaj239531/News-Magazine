<?php

namespace App\Services;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Models\Setting;

class SeoService
{
    protected $defaults;

    public function __construct()
    {
        $siteName = Setting::get('site_name', config('app.name', 'Vigyanmev Jayate'));
        $siteTagline = Setting::get('site_tagline', 'NATIONAL HINDI ENGLISH MONTHLY SCIENTIFIC MAGAZINE');
        
        // Build default description using site tagline or footer settings
        $siteDescription = Setting::get('footer_about_text') 
            ? strip_tags(Setting::get('footer_about_text')) 
            : config('seo.default_description', 'Professional Laravel development services');
        
        $twitterHandle = Setting::get('social_twitter') 
            ? '@' . ltrim(Setting::get('social_twitter'), '@') 
            : config('seo.twitter_handle', '@yourhandle');

        $this->defaults = [
            'title' => $siteName,
            'description' => $siteDescription,
            'separator' => ' | ',
            'image' => asset('images/logo.png'), // fallback to the logo.png in the project
            'keywords' => config('seo.keywords', ['laravel', 'web development', 'php', 'scientific magazine', 'vigyanmev jayate']),
            'author' => $siteName,
            'twitter_handle' => $twitterHandle,
        ];
    }

    /**
     * Set basic SEO meta tags
     */
    public function setBasicSeo(string $title, ?string $description = null, ?string $keywords = null): self
    {
        $siteName = $this->defaults['title'];
        
        // Avoid duplicating the site name in the title
        if (strpos($title, $siteName) !== false) {
            $fullTitle = $title;
        } else {
            $fullTitle = $title . $this->defaults['separator'] . $siteName;
        }
        
        SEOTools::setTitle($fullTitle);
        
        $description = $description ?? $this->defaults['description'];
        SEOTools::setDescription($this->truncate($description, 160));
        
        if ($keywords) {
            SEOTools::metatags()->setKeywords($keywords);
        } elseif (!empty($this->defaults['keywords'])) {
            SEOTools::metatags()->setKeywords($this->defaults['keywords']);
        }
        
        return $this;
    }

    /**
     * Set Open Graph tags for social sharing
     */
    public function setOpenGraph(string $title, string $description, ?string $image = null, string $type = 'website'): self
    {
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($this->truncate($description, 200));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setType($type);
        OpenGraph::setSiteName($this->defaults['title']);
        
        $image = $image ?? $this->defaults['image'];
        OpenGraph::addImage($image);
        
        return $this;
    }

    /**
     * Set Twitter Card tags
     */
    public function setTwitterCard(string $title, string $description, ?string $image = null, string $card = 'summary_large_image'): self
    {
        TwitterCard::setTitle($title);
        TwitterCard::setDescription($this->truncate($description, 200));
        TwitterCard::setType($card);
        TwitterCard::setImage($image ?? $this->defaults['image']);
        
        if ($this->defaults['twitter_handle']) {
            TwitterCard::setSite($this->defaults['twitter_handle']);
        }
        
        return $this;
    }

    /**
     * Set JSON-LD structured data
     */
    public function setStructuredData(array $data, string $type = 'WebPage'): self
    {
        JsonLd::setType($type);
        
        foreach ($data as $key => $value) {
            JsonLd::addValue($key, $value);
        }
        
        return $this;
    }

    /**
     * Set canonical URL
     */
    public function setCanonical(?string $url = null): self
    {
        SEOTools::setCanonical($url ?? url()->current());
        return $this;
    }

    /**
     * Set robots meta
     */
    public function setRobots(string $robots = 'index, follow'): self
    {
        SEOTools::metatags()->setRobots($robots);
        return $this;
    }

    /**
     * Set all SEO data at once for a post/page
     */
    public function setForContent(array $data): self
    {
        $title = $data['title'] ?? $this->defaults['title'];
        $description = $data['description'] ?? $data['excerpt'] ?? $this->defaults['description'];
        $image = $data['image'] ?? $data['featured_image'] ?? $this->defaults['image'];
        $keywords = $data['keywords'] ?? $data['tags'] ?? $this->defaults['keywords'];
        $type = $data['type'] ?? 'article';
        $author = $data['author'] ?? $this->defaults['author'];
        $publishedAt = $data['published_at'] ?? now();
        
        $this->setBasicSeo($title, $description, $keywords);
        $this->setOpenGraph($title, $description, $image, $type);
        $this->setTwitterCard($title, $description, $image);
        $this->setCanonical($data['canonical'] ?? null);
        
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => $type === 'article' ? 'Article' : 'WebPage',
            'headline' => $title,
            'description' => $this->truncate($description, 200),
            'image' => $image,
            'author' => [
                '@type' => 'Person',
                'name' => $author
            ],
            'datePublished' => $publishedAt,
            'dateModified' => $data['updated_at'] ?? $publishedAt,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => url()->current()
            ]
        ];
        
        $this->setStructuredData($structuredData, $type === 'article' ? 'Article' : 'WebPage');
        
        return $this;
    }

    /**
     * Set SEO for paginated pages
     */
    public function setForPagination(string $baseTitle, int $currentPage, string $description): self
    {
        $title = $currentPage > 1 
            ? $baseTitle . " - Page {$currentPage}" 
            : $baseTitle;
        
        $this->setBasicSeo($title, $description);
        $this->setOpenGraph($title, $description);
        $this->setTwitterCard($title, $description);
        
        if ($currentPage > 1) {
            SEOTools::metatags()->addMeta('prev', url()->current() . '?page=' . ($currentPage - 1));
        }
        
        return $this;
    }

    /**
     * Set SEO for blog posts / articles
     */
    public function setForPost($post): self
    {
        $data = [
            'title' => $post->title,
            'description' => strip_tags($post->content),
            'image' => $post->image_path ? asset($post->image_path) : $this->defaults['image'],
            'keywords' => $post->category ?? $this->defaults['keywords'],
            'type' => 'article',
            'author' => $this->defaults['author'],
            'published_at' => $post->created_at,
            'updated_at' => $post->updated_at,
            'canonical' => route('news.detail', $post->slug)
        ];
        
        return $this->setForContent($data);
    }

    /**
     * Helper to truncate text
     */
    public function truncate(string $text, int $length): string
    {
        if (strlen($text) <= $length) {
            return $text;
        }
        
        return substr($text, 0, $length) . '...';
    }

    /**
     * Set current URL as canonical
     */
    public function setCurrentUrlAsCanonical(): self
    {
        SEOTools::setCanonical(url()->current());
        return $this;
    }

    /**
     * Get all SEO data as array
     */
    public function getAll(): array
    {
        return [
            'title' => SEOTools::metatags()->getTitle(),
            'description' => SEOTools::metatags()->getDescription(),
            'canonical' => SEOTools::metatags()->getCanonical(),
            'og' => OpenGraph::generate(),
            'twitter' => TwitterCard::generate(),
            'jsonld' => JsonLd::generate(),
        ];
    }
}
