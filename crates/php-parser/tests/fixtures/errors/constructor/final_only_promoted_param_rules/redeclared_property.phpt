===source===
<?php
class C {
    public $d;
    function __construct(final $d) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'final promoted properties' requires PHP 8.5 or higher
Cannot redeclare C::$d
===errors 8.0-8.4===
'final promoted properties' requires PHP 8.5 or higher
Cannot redeclare C::$d
===errors >=8.5===
Cannot redeclare C::$d
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'final' (T_FINAL), expecting variable (T_VARIABLE) in Standard input code on line 4
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "final", expecting variable in Standard input code on line 4
===php_error 8.3-8.4===
PHP Fatal error:  Cannot use the final modifier on a parameter in Standard input code on line 4
===php_error >=8.5===
PHP Fatal error:  Cannot redeclare C::$d in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "d",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 29
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 44,
                      "end": 55
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "d",
                        "span": {
                          "start": 62,
                          "end": 64
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "is_final": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 56,
                        "end": 64
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 35,
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
