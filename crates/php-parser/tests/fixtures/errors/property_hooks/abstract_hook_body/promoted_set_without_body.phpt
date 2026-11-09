===source===
<?php
class B {
    public function __construct(public $h { set; }) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
Non-abstract property hook must have a body
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
Non-abstract property hook must have a body
===errors >=8.4===
Non-abstract property hook must have a body
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Non-abstract property hook must have a body in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
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
                        "name": "h",
                        "span": {
                          "start": 55,
                          "end": 57
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Set",
                          "body": "Abstract",
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 60,
                            "end": 64
                          }
                        }
                      ],
                      "span": {
                        "start": 48,
                        "end": 66
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
                "end": 70
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}
