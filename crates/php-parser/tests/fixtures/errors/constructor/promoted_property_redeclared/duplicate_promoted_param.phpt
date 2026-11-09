===source===
<?php
trait T {
    public function __construct(protected $x, protected $x) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
Redefinition of parameter $x
===errors >=8.0===
Redefinition of parameter $x
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'protected' (T_PROTECTED), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Redefinition of parameter $x in Standard input code on line 3
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
                    },
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 72,
                          "end": 74
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
                        "start": 62,
                        "end": 74
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
                "end": 78
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}
