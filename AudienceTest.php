public function testCheckRedirect(): void {
  $this->getSession()->getDriver()->getClient()->followRedirects(FALSE);

  // Create a node.
  $node = $this->createNode([
    'type' => 'article',
    'title' => 'Test Node',
  ]);

  $canonical_path = '/node/' . $node->id();

  // Redirect from /old-path to canonical node.
  $source = 'old-path';
  $redirect = Redirect::create([
    'redirect_source' => ['path' => $source],
    'redirect_redirect' => ['uri' => 'internal:' . $canonical_path],
    'status_code' => 301,
  ]);
  $redirect->save();

  // Visit the redirect source.
  $this->getSession()->visit('/' . $source);

  // Assert redirect.
  $status_code = $this->getSession()->getStatusCode();
  $this->assertEquals(301, $status_code, 'Redirect response returned 301.');

  $response = $this->getSession()->getDriver()->getClient()->getResponse();
  $headers = $response->getHeaders();
  $this->assertArrayHasKey('Location', $headers);
  $redirect_location = $headers['Location'][0];
  $this->assertEquals($canonical_path, $redirect_location);

  $this->getSession()->getDriver()->getClient()->followRedirects(TRUE);
}