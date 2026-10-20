===source===
<?php
trait T { final private $x; }
===errors >=8.4===
Property cannot be both final and private
===php_error <=8.0===
PHP Fatal error:  Cannot declare property T::$x final, the final modifier is allowed only for methods and classes in Standard input code on line 2
===php_error 8.1-8.2===
PHP Fatal error:  Cannot declare property T::$x final, the final modifier is allowed only for methods, classes, and class constants in Standard input code on line 2
===php_error 8.3===
PHP Fatal error:  Cannot use the final modifier on a property in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Property cannot be both final and private in Standard input code on line 2
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "x",
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
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
