<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{env("WEBSITE_URL")}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'about-us'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'services'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'membership-directory'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'contact-us'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'publications'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'news'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'prev-events'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'upcoming-events'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'internal-projects'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'news-and-events'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'chambers-law'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'board-of-directors'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'our-sponsors'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    <url>
        <loc>{{env("WEBSITE_URL"). 'e-services'}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    @foreach ($services as $service)
    <url>
        <loc>{{env("WEBSITE_URL"). 'services/'.$service->slug}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    @endforeach
    @foreach ($e_services as $eservice)
    <url>
        <loc>{{env("WEBSITE_URL"). 'e-services/'.$eservice->slug}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    @endforeach
    @foreach ($news as $single_news)
    <url>
        <loc>{{env("WEBSITE_URL"). 'news/'.$single_news->slug}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    @endforeach
    @foreach ($past_events as $event)
    <url>
        <loc>{{env("WEBSITE_URL"). 'prev-events/'.$event->slug}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    @endforeach
    @foreach ($upcoming_events as $event)
    <url>
        <loc>{{env("WEBSITE_URL"). 'upcoming-events/'.$event->slug}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    @endforeach
    @foreach ($single_directory as $dir)
    <url>
        <loc>{{env("WEBSITE_URL"). 'membership-directory/'.$dir->slug}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    @endforeach
    @foreach ($projects as $project)
    <url>
        <loc>{{env("WEBSITE_URL"). 'international-projects/'.$project->slug}}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
    </url>
    @endforeach
</urlset>