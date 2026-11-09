===source===
<?php
class A {
    var callable $c;
}
===errors===
Property A::$c cannot have type callable
===php_error===
PHP Fatal error:  Property A::$c cannot have type callable in Standard input code on line 3
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
                    "name": "c",
                    "span": {
                      "start": 33,
                      "end": 35
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_var": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "callable"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 24,
                          "end": 32
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 32
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 35
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
