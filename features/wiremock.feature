Feature: Wiremock test
  In order to use wiremock
  As a feature automator
  I need to be able to initialize wiremock and get response

  Scenario: Tests default functionality
    Given a file named "data/mapping.json" with:
    """
    {
      "request": {
        "method": "GET",
        "url": "/hello/world"
      },
      "response": {
        "status": 200,
        "body": "Hello world!",
        "headers": {
          "Content-Type": "text/plain"
        }
      }
    }
    """
    Given a file named "data/mapping2.json" with:
    """
    {
      "request": {
        "method": "GET",
        "url": "/hello/mark"
      },
      "response": {
        "status": 200,
        "body": "Hello mark!",
        "headers": {
          "Content-Type": "text/plain"
        }
      }
    }
    """
    Given a file named "behat.yml" with:
    """
    default:
      autoload:
        '': %paths.base%/features/bootstrap/
      suites:
        default:
          path: %paths.base%/features
      extensions:
        Behat\WiremockExtension\ServiceContainer\Extension:
          wiremock:
            services:
              client1:
                base_url: http://192.168.205.11
                mappings_path: %paths.base%/data/mapping.json
              client2:
                base_url: http://192.168.205.12
                mappings_path: %paths.base%/data/mapping2.json

      """
    And a file named "features/bootstrap/FeatureContext.php" with:
    """
      <?php
      use Behat\Behat\Context\Context;
      class FeatureContext implements Context
      {

        /**
         * @Given I send GET request to :arg1 expect :arg2
         */
        public function callService($path, $expect)
        {
          $ch = curl_init($path);
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          if( ! $result = curl_exec($ch))
          {
              trigger_error(curl_error($ch));
          }
          curl_close($ch);
          if ($expect != $result){
            throw new \Exception('Mismatch: "' . $result . '" != "' . $expect . '"');
          }
        }
      }
      """
    And a file named "features/feature.feature" with:
    """
      Feature:
        Scenario:
          Given I send GET request to "192.168.205.11/hello/world" expect "Hello world!"
          And I send GET request to "192.168.205.12/hello/mark" expect "Hello mark!"
      """
    When I run "behat -f progress --no-colors --append-snippets"
    Then it should pass with:
    """
    ..

    1 scenario (1 passed)
    2 steps (2 passed)
    """

  Scenario: Tests tag marked scenarios functionality
    Given a file named "data/mapping.json" with:
    """
    {
      "request": {
        "method": "GET",
        "url": "/hello/world"
      },
      "response": {
        "status": 200,
        "body": "Tests tags",
        "headers": {
          "Content-Type": "text/plain"
        }
      }
    }
    """
    Given a file named "data/mapping2.json" with:
    """
    {
      "request": {
        "method": "GET",
        "url": "/hello/mark"
      },
      "response": {
        "status": 200,
        "body": "Tests tags 2",
        "headers": {
          "Content-Type": "text/plain"
        }
      }
    }
    """
    Given a file named "behat.yml" with:
    """
    default:
      autoload:
        '': %paths.base%/features/bootstrap/
      suites:
        default:
          path: %paths.base%/features
      extensions:
        Behat\WiremockExtension\ServiceContainer\Extension:
          wiremock:
            reset_strategy:
              name: by_tags
              options:
                services:
                  client1: wiremockService1Reset
                  client2: wiremockService2Reset
            services:
              client1:
                base_url: http://192.168.205.11
                mappings_path: %paths.base%/data/mapping.json
              client2:
                base_url: http://192.168.205.12
                mappings_path: %paths.base%/data/mapping2.json

      """
    And a file named "features/bootstrap/FeatureContext.php" with:
    """
      <?php
      use Behat\Behat\Context\Context;
      class FeatureContext implements Context
      {

        /**
         * @Given I send GET request to :arg1 expect :arg2
         */
        public function callService($path, $expect)
        {
          $ch = curl_init($path);
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          if( ! $result = curl_exec($ch))
          {
              trigger_error(curl_error($ch));
          }
          curl_close($ch);
          if ($expect != $result){
            throw new \Exception('Mismatch: "' . $result . '" != "' . $expect . '"');
          }
        }
      }
      """
    And a file named "features/feature2.feature" with:
    """
      Feature:
        @wiremockService1Reset
        Scenario:
          Given I send GET request to "192.168.205.11/hello/world" expect "Tests tags"

        @wiremockService2Reset
        Scenario:
          Given I send GET request to "192.168.205.12/hello/mark" expect "Tests tags 2"
      """
    When I run "behat -f progress --no-colors --append-snippets"
    Then it should pass with:
    """
    ..

    2 scenarios (2 passed)
    2 steps (2 passed)
    """