===config===
min_php=8.5
===source===
<?php $r = $value |> 'strtoupper' |> (fn($s) => trim($s));
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
                  "Variable": "r"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "value"
                            },
                            "span": {
                              "start": 11,
                              "end": 17
                            }
                          },
                          "op": "Pipe",
                          "right": {
                            "kind": {
                              "String": "strtoupper"
                            },
                            "span": {
                              "start": 21,
                              "end": 33
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 33
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "ArrowFunction": {
                              "is_static": false,
                              "by_ref": false,
                              "params": [
                                {
                                  "name": {
                                    "name": "s",
                                    "span": {
                                      "start": 41,
                                      "end": 43
                                    }
                                  },
                                  "type_hint": null,
                                  "default": null,
                                  "by_ref": false,
                                  "variadic": false,
                                  "attributes": [],
                                  "span": {
                                    "start": 41,
                                    "end": 43
                                  }
                                }
                              ],
                              "return_type": null,
                              "body": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "trim"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 48,
                                            "end": 52
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 48,
                                        "end": 52
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "s"
                                            },
                                            "span": {
                                              "start": 53,
                                              "end": 55
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 53,
                                          "end": 55
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 48,
                                  "end": 56
                                }
                              },
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 56
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 57
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 57
          }
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
