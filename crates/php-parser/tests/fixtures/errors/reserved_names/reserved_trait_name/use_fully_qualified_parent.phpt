===source===
<?php
class A {
    use \parent;
}
===errors===
'\parent' is an invalid class name
===php_error <=7.4===
PHP Fatal error:  Cannot use 'parent' as trait name as it is reserved in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  '\parent' is an invalid class name in Standard input code on line 3
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
          "implements": [],
          "members": [
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "parent"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 24,
                        "end": 31
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
