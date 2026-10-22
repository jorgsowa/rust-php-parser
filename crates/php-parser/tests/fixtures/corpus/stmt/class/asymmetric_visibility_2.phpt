===source===
<?php
class Test {
    private(set) private(set) $x;
    private(set) public(set) $x;
}
===errors <=8.3===
cannot use multiple set-visibility modifiers
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$x must have type
cannot use multiple set-visibility modifiers
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$x must have type
Cannot redeclare Test::$x
===errors >=8.4===
cannot use multiple set-visibility modifiers
Property with asymmetric visibility Test::$x must have type
cannot use multiple set-visibility modifiers
Property with asymmetric visibility Test::$x must have type
Cannot redeclare Test::$x
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 3
===php_error 8.2-8.3===
PHP Parse error:  syntax error, unexpected token ")", expecting amp in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 12,
              "end": 16
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
                      "start": 49,
                      "end": 51
                    }
                  },
                  "modifiers": {
                    "set_visibility": "Private"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 51
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 82,
                      "end": 84
                    }
                  },
                  "modifiers": {
                    "set_visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 57,
                "end": 84
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 87
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87
  }
}
