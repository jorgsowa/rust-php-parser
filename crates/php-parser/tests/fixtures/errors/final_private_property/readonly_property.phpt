===source===
<?php
class A { final private readonly int $x; }
===errors >=8.4===
Property cannot be both final and private
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 2
===php_error 8.1-8.2===
PHP Fatal error:  Cannot declare property A::$x final, the final modifier is allowed only for methods, classes, and class constants in Standard input code on line 2
===php_error 8.3===
PHP Fatal error:  Cannot use the final modifier on a property in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Property cannot be both final and private in Standard input code on line 2
===ast >=8.4===
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
                    "name": "x",
                    "span": {
                      "start": 43,
                      "end": 45
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true,
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 39,
                          "end": 42
                        }
                      }
                    },
                    "span": {
                      "start": 39,
                      "end": 42
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
