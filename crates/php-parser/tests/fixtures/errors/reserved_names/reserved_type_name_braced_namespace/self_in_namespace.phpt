===source===
<?php
namespace M {
    function f(?namespace\self $b) {}
}
===errors===
Cannot use "self" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 3
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
                          "name": "b",
                          "span": {
                            "start": 51,
                            "end": 53
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Nullable": {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "self"
                                  ],
                                  "kind": "Relative",
                                  "span": {
                                    "start": 36,
                                    "end": 50
                                  }
                                }
                              },
                              "span": {
                                "start": 36,
                                "end": 50
                              }
                            }
                          },
                          "span": {
                            "start": 35,
                            "end": 50
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 35,
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
                  "start": 24,
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
