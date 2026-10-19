===source===
<?php
function f() { $a = function (callable\X $x): never\Y {}; $b = fn(bool\X $x): int\Y => 1; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 21,
                          "end": 23
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Closure": {
                            "is_static": false,
                            "by_ref": false,
                            "params": [
                              {
                                "name": {
                                  "name": "x",
                                  "span": {
                                    "start": 47,
                                    "end": 49
                                  }
                                },
                                "type_hint": {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "callable",
                                        "X"
                                      ],
                                      "kind": "Qualified",
                                      "span": {
                                        "start": 36,
                                        "end": 46
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 36,
                                    "end": 46
                                  }
                                },
                                "default": null,
                                "by_ref": false,
                                "variadic": false,
                                "attributes": [],
                                "span": {
                                  "start": 36,
                                  "end": 49
                                }
                              }
                            ],
                            "use_vars": [],
                            "return_type": {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "never",
                                    "Y"
                                  ],
                                  "kind": "Qualified",
                                  "span": {
                                    "start": 52,
                                    "end": 59
                                  }
                                }
                              },
                              "span": {
                                "start": 52,
                                "end": 59
                              }
                            },
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 26,
                          "end": 62
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 62
                  }
                }
              },
              "span": {
                "start": 21,
                "end": 63
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 64,
                          "end": 66
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
                                  "name": "x",
                                  "span": {
                                    "start": 79,
                                    "end": 81
                                  }
                                },
                                "type_hint": {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "bool",
                                        "X"
                                      ],
                                      "kind": "Qualified",
                                      "span": {
                                        "start": 72,
                                        "end": 78
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 72,
                                    "end": 78
                                  }
                                },
                                "default": null,
                                "by_ref": false,
                                "variadic": false,
                                "attributes": [],
                                "span": {
                                  "start": 72,
                                  "end": 81
                                }
                              }
                            ],
                            "return_type": {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "int",
                                    "Y"
                                  ],
                                  "kind": "Qualified",
                                  "span": {
                                    "start": 84,
                                    "end": 89
                                  }
                                }
                              },
                              "span": {
                                "start": 84,
                                "end": 89
                              }
                            },
                            "body": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 93,
                                "end": 94
                              }
                            },
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 69,
                          "end": 94
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 64,
                    "end": 94
                  }
                }
              },
              "span": {
                "start": 64,
                "end": 95
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 97
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 97
  }
}
