===source===
<?php
$f = function &() { yield from f(); };
===errors===
Cannot use "yield from" inside a by-reference generator
===php_error <=8.1===
PHP Fatal error:  Cannot use "yield from" inside a by-reference generator in Standard input code on line 2
===php_error 8.2===
PHP Fatal error:  Cannot use "yield from" inside a by-reference generator in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "yield from" inside a by-reference generator in Standard input code on line 2
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
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": true,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Expression": {
                            "kind": {
                              "Yield": {
                                "key": null,
                                "value": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "f"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 37,
                                              "end": 38
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 37,
                                          "end": 38
                                        }
                                      },
                                      "args": []
                                    }
                                  },
                                  "span": {
                                    "start": 37,
                                    "end": 40
                                  }
                                },
                                "is_from": true
                              }
                            },
                            "span": {
                              "start": 26,
                              "end": 40
                            }
                          }
                        },
                        "span": {
                          "start": 26,
                          "end": 41
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 43
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 43
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
