<?php


use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    protected $article;

    protected function setUp(): void
    {
        $this->article = new App\Article();
    }

    public function testTitleIsEmptyByDefault()
    {
        $this->assertEmpty($this->article->title);
    }
//
    public function testSlugIsEmptyWithNoTitle()
    {
        // assertSame does full equivalence comparison
        $this->assertSame( "", $this->article->getSlug());
    }
//
//    public function testSlugHasSpacesReplacedByUnderscores()
//    {
//        $this->article->title = "An Example article";
//
//        $this->assertEquals('An_Example_article', $this->article->getSlug());
//    }
//
//    public function testSlugHasWhitespaceReplaceBySingleUnderscore()
//    {
//        $this->article->title = "An     Example  \n  article";
//
//        $this->assertEquals('An_Example_article', $this->article->getSlug());
//    }
//
//    public function testSlugDoesNotStartOrEndWithAnUnderscore()
//    {
//        $this->article->title = " An Example article ";
//
//
//        $this->assertEquals('An_Example_article', $this->article->getSlug());
//    }
//
//    public function testSlugDoesNotHaveAnyNonWorkCharacters()
//    {
//        $this->article->title = 'Read! This! Now!';
//
//        $this->assertEquals('Read_This_Now', $this->article->getSlug());
//    }

    public function titleProvider()
    {
        // when using title providers, we can use verbose keys to replace the descriptive test method titles
        return [
            'Slug Has Spaces Replaced By Underscores' => ["An Example article", "An_Example_article"],
            ["An     Example  \n  article", "An_Example_article"],
            [" An Example article ", "An_Example_article"],
            ["Read! This! Now!", "Read_This_Now"],
        ];
    }

    /**
     * @dataProvider titleProvider
     */
    public function testSlug($title, $slug)
    {
        $this->article->title = $title;

        $this->assertEquals($slug, $this->article->getSlug());
    }
}
