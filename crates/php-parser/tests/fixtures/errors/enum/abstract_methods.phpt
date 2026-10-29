===source===
<?php
enum E {
    abstract function f();
    abstract function g();
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Enum method E::f() must not be abstract
Enum method E::g() must not be abstract
===errors >=8.1===
Enum method E::f() must not be abstract
Enum method E::g() must not be abstract
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Class E contains 2 abstract methods and must therefore be declared abstract or implement the remaining methods (E::f, E::g) in Standard input code on line 2
===php_error 8.2-8.4===
PHP Fatal error:  Enum E must implement 2 abstract private methods (E::f, E::g) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Enum method E::f() must not be abstract in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 37,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 41
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 64,
                      "end": 65
                    }
                  },
                  "modifiers": {
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 46,
                "end": 68
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
