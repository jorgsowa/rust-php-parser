===source===
<?php
abstract class A {
    abstract function __construct(final $b);
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
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                      "start": 47,
                      "end": 58
                    }
                  },
                  "modifiers": {
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 65,
                          "end": 67
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
                        "start": 59,
                        "end": 67
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 69
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
