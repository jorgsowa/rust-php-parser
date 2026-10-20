===description===
A doc comment inside a statement's call arguments belongs to that expression and is not attached to the next statement.
===source===
<?php
foo(/** @param T $x */ fn($x) => $x, $other);

bar();

/** legit doc comment */
baz();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrowFunction": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [
                            {
                              "name": {
                                "name": "x",
                                "span": {
                                  "start": 32,
                                  "end": 34
                                }
                              },
                              "type_hint": null,
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
                              "attributes": [],
                              "span": {
                                "start": 32,
                                "end": 34
                              }
                            }
                          ],
                          "return_type": null,
                          "body": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 39,
                              "end": 41
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 41
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 41
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "other"
                      },
                      "span": {
                        "start": 43,
                        "end": 49
                      }
                    }
                  },
                  "span": {
                    "start": 43,
                    "end": 49
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 50
          }
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "bar"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 53,
                      "end": 56
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 56
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 53,
            "end": 58
          }
        }
      },
      "span": {
        "start": 53,
        "end": 59
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "baz"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 86,
                      "end": 89
                    }
                  }
                },
                "span": {
                  "start": 86,
                  "end": 89
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 86,
            "end": 91
          }
        }
      },
      "span": {
        "start": 86,
        "end": 92
      },
      "doc_comment": {
        "kind": "Doc",
        "text": "/** legit doc comment */",
        "span": {
          "start": 61,
          "end": 85
        }
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
