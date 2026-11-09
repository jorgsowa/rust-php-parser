===source===
<?php
class A {
    public parent $a;
}
===errors >=8.0===
Cannot use "parent" when current class scope has no parent
===php_error >=8.0===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 3
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 33
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 36
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
