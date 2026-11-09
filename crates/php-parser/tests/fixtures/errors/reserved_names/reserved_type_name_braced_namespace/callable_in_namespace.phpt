===source===
<?php
namespace M {
    function f(namespace\Foo\callable $a) {}
}
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===errors >=8.5===
Cannot use "M\Foo\callable" as a type name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'callable' (T_CALLABLE), expecting identifier (T_STRING) in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Cannot use "M\Foo\callable" as a type name as it is reserved in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "M"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 33,
                        "end": 34
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 58,
                            "end": 60
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Foo",
                                "callable"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 35,
                                "end": 57
                              }
                            }
                          },
                          "span": {
                            "start": 35,
                            "end": 57
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 35,
                          "end": 60
                        }
                      }
                    ],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 24,
                  "end": 64
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
