===source===
<?php
$f = fn&() => yield from f();
===errors===
Cannot use "yield from" inside a by-reference generator
===php_error <=8.1===
PHP Fatal error:  Cannot use "yield from" inside a by-reference generator in Standard input code on line 2
===php_error 8.2===
Cannot load Xdebug - it was already loaded
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
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": true,
                    "params": [],
                    "return_type": null,
                    "body": {
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
                                        "start": 31,
                                        "end": 32
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 31,
                                    "end": 32
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 31,
                              "end": 34
                            }
                          },
                          "is_from": true
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 34
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
