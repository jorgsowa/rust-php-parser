===source===
<?php
trait T {
    public function __construct(protected $x) {}
    public $x;
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
Cannot redeclare T::$x
===errors >=8.0===
Cannot redeclare T::$x
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'protected' (T_PROTECTED), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Cannot redeclare T::$x in Standard input code on line 4
===ast===
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 58,
                          "end": 60
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 60
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 64
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 76,
                      "end": 78
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
                "start": 69,
                "end": 78
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 81
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 81
  }
}
