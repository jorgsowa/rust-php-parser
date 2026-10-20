===description===
PHP rejects a property without hooks in an interface with "Interfaces may only include hooked properties".
===source===
<?php
interface I {
    public int $x;
}
===errors >=8.4===
Interfaces may only include hooked properties
===php_error <=8.0===
PHP Fatal error:  Interfaces may not include member variables in Standard input code on line 3
===php_error 8.1-8.3===
PHP Fatal error:  Interfaces may not include properties in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Interfaces may only include hooked properties in Standard input code on line 3
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 35,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 31,
                          "end": 34
                        }
                      }
                    },
                    "span": {
                      "start": 31,
                      "end": 34
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 37
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
