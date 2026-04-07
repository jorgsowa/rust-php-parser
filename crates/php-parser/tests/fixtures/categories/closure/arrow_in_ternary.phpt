===source===
<?php $fn = $flag ? fn($x) => $x + 1 : fn($x) => $x - 1;
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
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "flag"
                      },
                      "span": {
                        "start": 12,
                        "end": 17
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "ArrowFunction": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [
                            {
                              "name": "x",
                              "type_hint": null,
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
                              "is_readonly": false,
                              "is_final": false,
                              "visibility": null,
                              "set_visibility": null,
                              "attributes": [],
                              "span": {
                                "start": 23,
                                "end": 25
                              }
                            }
                          ],
                          "return_type": null,
                          "body": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "x"
                                  },
                                  "span": {
                                    "start": 30,
                                    "end": 32
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 35,
                                    "end": 36
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 30,
                              "end": 36
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 36
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "ArrowFunction": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [
                            {
                              "name": "x",
                              "type_hint": null,
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
                              "is_readonly": false,
                              "is_final": false,
                              "visibility": null,
                              "set_visibility": null,
                              "attributes": [],
                              "span": {
                                "start": 42,
                                "end": 44
                              }
                            }
                          ],
                          "return_type": null,
                          "body": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "x"
                                  },
                                  "span": {
                                    "start": 49,
                                    "end": 51
                                  }
                                },
                                "op": "Sub",
                                "right": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 54,
                                    "end": 55
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 49,
                              "end": 55
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 39,
                        "end": 55
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 55
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 55
          }
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
