===source===
<?php $f = fn() => throw new Exception();
===errors <=7.4===
'throw expressions' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'throw' (T_THROW) in Standard input code on line 1
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
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Throw": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "Exception"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 29,
                                      "end": 38
                                    }
                                  }
                                },
                                "span": {
                                  "start": 29,
                                  "end": 38
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 25,
                            "end": 40
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 40
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 40
          }
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
