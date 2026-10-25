===source===
<?php
function g() {
    yield /**/ from [1];
    yield/**/from;
}
===errors >=8.3===
expected expression, found ';'
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 4
===ast <=8.2===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
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
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "from"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 36,
                                    "end": 40
                                  }
                                }
                              },
                              "span": {
                                "start": 36,
                                "end": 40
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 42,
                                "end": 43
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 44
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 44
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 45
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "from"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 59,
                              "end": 63
                            }
                          }
                        },
                        "span": {
                          "start": 59,
                          "end": 63
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 50,
                    "end": 63
                  }
                }
              },
              "span": {
                "start": 50,
                "end": 64
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
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
===ast >=8.3===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
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
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 42,
                                    "end": 43
                                  }
                                }
                              },
                              "span": {
                                "start": 42,
                                "end": 43
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 41,
                          "end": 44
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 44
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 45
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": "Error",
                        "span": {
                          "start": 63,
                          "end": 63
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 50,
                    "end": 63
                  }
                }
              },
              "span": {
                "start": 50,
                "end": 64
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
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
