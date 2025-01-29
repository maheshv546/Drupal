(function ($, Drupal) {
    Drupal.behaviors.recentNodes = {
      attach: function (context, settings) {
        const maxRecentNodes = 3;
        const localStorageKey = 'recent_nodes';
  
        // Function to store node data in localStorage.
        function storeNode(nodeId, nodeTitle, nodeUrl) {
          // Get the current list from localStorage.
          let recentNodes = JSON.parse(localStorage.getItem(localStorageKey)) || [];
  
          // Remove the node if it already exists to avoid duplicates.
          recentNodes = recentNodes.filter((node) => node.id !== nodeId);
  
          // Add the new node to the beginning of the list.
          recentNodes.unshift({ id: nodeId, title: nodeTitle, url: nodeUrl });
  
          // Limit to the most recent `maxRecentNodes`.
          recentNodes = recentNodes.slice(0, maxRecentNodes);
  
          // Save back to localStorage.
          localStorage.setItem(localStorageKey, JSON.stringify(recentNodes));
        }
  
        // Function to render recent nodes in the block.
        function renderRecentNodes() {
          const recentNodes = JSON.parse(localStorage.getItem(localStorageKey)) || [];
          const $container = $('#recent-nodes', context);
  
          if (recentNodes.length > 0) {
            let html = '<ul>';
            recentNodes.forEach((node) => {
              html += `
                <li>
                  <a href="${node.url}">${node.title}</a> (Node ID: ${node.id})
                </li>
              `;
            });
            html += '</ul>';
            $container.html(html);
          } else {
            $container.html('<p>No recently viewed nodes.</p>');
          }
        }
  
        // Check if the current page is a node page.
        const nodeIdMatch = drupalSettings.path.currentPath.match(/^node\/(\d+)/);
        if (nodeIdMatch) {
          const nodeId = nodeIdMatch[1];
          const nodeTitle = $('h1.page-title').text().trim();
          const nodeUrl = window.location.href;
  
          // Store the current node in localStorage.
          storeNode(nodeId, nodeTitle, nodeUrl);
        }
  
        // Render the recent nodes in the block.
        renderRecentNodes();
      },
    };
  })(jQuery, Drupal);
  