A brief report on design decisions and problem-solving approaches of Sentiment Analyzer

Step I followed,

1. setup file structure,
  -Here i add main file and require additional file which i added inside the innclude folders to keep code clean.

2. Implement the sentiment Count logic,
   - Here i declear 3 Type of sentiment like positive, negative , neutral.
   - get their value from admin panel and setup a counter in order to count the number of words and then store the value in post meta with save_post hooks.

3. Display The Badge in Frontend,
   -Here I display specific badge with their colors in frontend where i get the post meta of sentiment based on id from BD where my table is _post_sentiment.

4. Admin Setting page
   -Here i created this sub menu in setting --> sentiment analyzer. Here we can add those keyword, at first i implemented hardcoaded then afte creating this page, the words will be took from here

5. Shortcode
  - Here I created shortcode which will show the number of sentiment list of post and has pagination option in shortcode.


Note- Due to Ramadan event and currently doing a job, I did not get enough scope to design the plugin as I got 1.5 days so i just keep it very ordinary and doesn't enqueue any stylesheet
