===source===
<?php
class A {
    public static never $b;
}
===errors >=8.1===
Property A::$b cannot have type never
===php_error >=8.1===
PHP Fatal error:  Property A::$b cannot have type never in Standard input code on line 3
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
                    "name": "b",
                    "span": {
                      "start": 40,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "never"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 34,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 39
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
