===source===
<?php interface A extends self {}
===errors===
Cannot use "self" as interface name, as it is reserved
===php_error <=7.4===
PHP Fatal error:  Cannot use 'self' as interface name as it is reserved in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  Cannot use "self" as interface name, as it is reserved in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "A",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [
            {
              "parts": [
                "self"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 26,
                "end": 30
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
