===source===
<?php
class A { final private static int $x; }
===errors <=8.3===
Property cannot be both final and private
'final properties' requires PHP 8.4 or higher
===errors >=8.4===
Property cannot be both final and private
===php_error <=8.0===
PHP Fatal error:  Cannot declare property A::$x final, the final modifier is allowed only for methods and classes in Standard input code on line 2
===php_error 8.1-8.2===
PHP Fatal error:  Cannot declare property A::$x final, the final modifier is allowed only for methods, classes, and class constants in Standard input code on line 2
===php_error 8.3===
PHP Fatal error:  Cannot use the final modifier on a property in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Property cannot be both final and private in Standard input code on line 2
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
                    "name": "x",
                    "span": {
                      "start": 41,
                      "end": 43
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_static": true,
                    "is_final": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 37,
                          "end": 40
                        }
                      }
                    },
                    "span": {
                      "start": 37,
                      "end": 40
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
