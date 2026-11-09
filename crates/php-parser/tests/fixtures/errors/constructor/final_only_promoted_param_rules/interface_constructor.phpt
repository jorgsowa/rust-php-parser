===source===
<?php
interface I {
    function __construct(final $a);
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'final promoted properties' requires PHP 8.5 or higher
Cannot declare promoted property in an abstract constructor
===errors 8.0-8.4===
'final promoted properties' requires PHP 8.5 or higher
Cannot declare promoted property in an abstract constructor
===errors >=8.5===
Cannot declare promoted property in an abstract constructor
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'final' (T_FINAL), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "final", expecting variable in Standard input code on line 3
===php_error 8.3-8.4===
PHP Fatal error:  Cannot use the final modifier on a parameter in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Cannot declare promoted property in an abstract constructor in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 33,
                      "end": 44
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 51,
                          "end": 53
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
                        "start": 45,
                        "end": 53
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 55
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
