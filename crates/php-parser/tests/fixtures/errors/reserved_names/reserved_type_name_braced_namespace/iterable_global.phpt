===source===
<?php
namespace {
    function f(namespace\iterable $b) {}
}
===errors===
Type declaration 'iterable' must be unqualified
===php_error===
PHP Fatal error:  Type declaration 'iterable' must be unqualified in Standard input code on line 3
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
                          "name": "b",
                          "span": {
                            "start": 52,
                            "end": 54
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "iterable"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 33,
                                "end": 51
                              }
                            }
                          },
                          "span": {
                            "start": 33,
                            "end": 51
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 33,
                          "end": 54
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
                  "end": 58
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
