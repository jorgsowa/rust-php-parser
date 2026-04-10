===source===
<?php $fn = fn(?string $s): ?int => $s ? strlen($s) : null;
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
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9
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
                        "name": "s",
                        "type_hint": {
                          "kind": {
                            "Nullable": {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "string"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 16,
                                    "end": 22
                                  }
                                }
                              },
                              "span": {
                                "start": 16,
                                "end": 22
                              }
                            }
                          },
                          "span": {
                            "start": 15,
                            "end": 22
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "is_readonly": false,
                        "is_final": false,
                        "visibility": null,
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 15,
                          "end": 25
                        }
                      }
                    ],
                    "return_type": {
                      "kind": {
                        "Nullable": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 29,
                                "end": 32
                              }
                            }
                          },
                          "span": {
                            "start": 29,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 32
                      }
                    },
                    "body": {
                      "kind": {
                        "Ternary": {
                          "condition": {
                            "kind": {
                              "Variable": "s"
                            },
                            "span": {
                              "start": 36,
                              "end": 38
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Identifier": "strlen"
                                  },
                                  "span": {
                                    "start": 41,
                                    "end": 47
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "value": {
                                      "kind": {
                                        "Variable": "s"
                                      },
                                      "span": {
                                        "start": 48,
                                        "end": 50
                                      }
                                    },
                                    "unpack": false,
                                    "by_ref": false,
                                    "span": {
                                      "start": 48,
                                      "end": 50
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 41,
                              "end": 51
                            }
                          },
                          "else_expr": {
                            "kind": "Null",
                            "span": {
                              "start": 54,
                              "end": 58
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 58
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 58
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 58
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
