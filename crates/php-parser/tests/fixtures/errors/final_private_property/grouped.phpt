===source===
<?php
class A { final private $a, $b; }
===errors <=8.3===
Property cannot be both final and private
'final properties' requires PHP 8.4 or higher
===errors >=8.4===
Property cannot be both final and private
===php_error <=8.0===
PHP Fatal error:  Cannot declare property A::$a final, the final modifier is allowed only for methods and classes in Standard input code on line 2
===php_error 8.1-8.2===
PHP Fatal error:  Cannot declare property A::$a final, the final modifier is allowed only for methods, classes, and class constants in Standard input code on line 2
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
                    "name": "a",
                    "span": {
                      "start": 30,
                      "end": 32
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 32
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
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
