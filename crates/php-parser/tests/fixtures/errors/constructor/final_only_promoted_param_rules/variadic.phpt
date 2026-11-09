===source===
<?php
class B {
    function __construct(final ...$c) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'final promoted properties' requires PHP 8.5 or higher
Cannot declare variadic promoted property
===errors 8.0-8.4===
'final promoted properties' requires PHP 8.5 or higher
Cannot declare variadic promoted property
===errors >=8.5===
Cannot declare variadic promoted property
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'final' (T_FINAL), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "final", expecting variable in Standard input code on line 3
===php_error 8.3-8.4===
PHP Fatal error:  Cannot use the final modifier on a parameter in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Cannot declare variadic promoted property in Standard input code on line 3
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
                      "start": 29,
                      "end": 40
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "c",
                        "span": {
                          "start": 50,
                          "end": 52
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "modifiers": {
                        "is_final": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 41,
                        "end": 52
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
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
