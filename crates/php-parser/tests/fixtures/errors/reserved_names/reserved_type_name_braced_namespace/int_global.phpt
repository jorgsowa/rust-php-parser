===source===
<?php
namespace {
    function f(namespace\Foo\int $a) {}
}
===errors===
Cannot use "Foo\int" as a type name as it is reserved
===php_error <=8.3===
PHP Fatal error:  Cannot use 'Foo\int' as class name as it is reserved in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use "Foo\int" as a type name as it is reserved in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 31,
                        "end": 32
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 51,
                            "end": 53
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Foo",
                                "int"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 33,
                                "end": 50
                              }
                            }
                          },
                          "span": {
                            "start": 33,
                            "end": 50
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 33,
                          "end": 53
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
                  "start": 22,
                  "end": 57
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
