===source===
<?php class A implements self {}
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
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [
            {
              "parts": [
                "self"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 25,
                "end": 29
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
