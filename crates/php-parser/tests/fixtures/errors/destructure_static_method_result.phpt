===source===
<?php [$a, [A::f()]] = $b;
===errors===
Can't use method return value in write context
===php_error===
PHP Fatal error:  Can't use method return value in write context in Standard input code on line 1
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "StaticMethodCall": {
                                        "class": {
                                          "kind": {
                                            "Name": {
                                              "parts": [
                                                "A"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 12,
                                                "end": 13
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 12,
                                            "end": 13
                                          }
                                        },
                                        "method": {
                                          "kind": {
                                            "Identifier": "f"
                                          },
                                          "span": {
                                            "start": 15,
                                            "end": 16
                                          }
                                        },
                                        "args": []
                                      }
                                    },
                                    "span": {
                                      "start": 12,
                                      "end": 18
                                    }
                                  }
                                },
                                "span": {
                                  "start": 12,
                                  "end": 18
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 11,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 20
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 23,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
