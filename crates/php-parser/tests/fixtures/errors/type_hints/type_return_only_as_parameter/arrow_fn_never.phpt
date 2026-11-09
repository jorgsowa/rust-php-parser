===source===
<?php
$d = fn(never $d) => 1;
===errors >=8.1===
never cannot be used as a parameter type
===php_error >=8.1===
PHP Fatal error:  never cannot be used as a parameter type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "d",
                          "span": {
                            "start": 20,
                            "end": 22
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "never"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 14,
                                "end": 19
                              }
                            }
                          },
                          "span": {
                            "start": 14,
                            "end": 19
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 14,
                          "end": 22
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 27,
                        "end": 28
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
