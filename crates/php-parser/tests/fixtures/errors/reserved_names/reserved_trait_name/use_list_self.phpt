===source===
<?php
class A {
    use T, self;
}
===errors===
Cannot use "self" as trait name, as it is reserved
===php_error <=7.4===
PHP Fatal error:  Cannot use 'self' as trait name as it is reserved in Standard input code on line 3
===php_error 8.0-8.3===
PHP Fatal error:  Cannot use 'self' as trait name, as it is reserved in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use "self" as trait name, as it is reserved in Standard input code on line 3
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
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    },
                    {
                      "parts": [
                        "self"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 27,
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
