===source===
<?php
unset((clone $a)->b);
foreach ($x as (clone $a)->b) {}
foreach ($x as &(clone $a)[0]) {}
[(clone $a)->b] = $x;
===errors===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Assignments can only happen to writable values
===php_error <=8.4===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Clone": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 19,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 21
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 22
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "b"
                  },
                  "span": {
                    "start": 24,
                    "end": 25
                  }
                }
              }
            },
            "span": {
              "start": 12,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 27
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 37,
              "end": 39
            }
          },
          "key": null,
          "value": {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Clone": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 50,
                            "end": 52
                          }
                        }
                      },
                      "span": {
                        "start": 44,
                        "end": 52
                      }
                    }
                  },
                  "span": {
                    "start": 43,
                    "end": 53
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "b"
                  },
                  "span": {
                    "start": 55,
                    "end": 56
                  }
                }
              }
            },
            "span": {
              "start": 43,
              "end": 56
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 58,
              "end": 60
            }
          }
        }
      },
      "span": {
        "start": 28,
        "end": 60
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 70,
              "end": 72
            }
          },
          "key": null,
          "value": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Clone": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 84,
                            "end": 86
                          }
                        }
                      },
                      "span": {
                        "start": 78,
                        "end": 86
                      }
                    }
                  },
                  "span": {
                    "start": 77,
                    "end": 87
                  }
                },
                "index": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 88,
                    "end": 89
                  }
                }
              }
            },
            "span": {
              "start": 77,
              "end": 90
            }
          },
          "by_ref": true,
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 92,
              "end": 94
            }
          }
        }
      },
      "span": {
        "start": 61,
        "end": 94
      }
    },
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
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Parenthesized": {
                                    "kind": {
                                      "Clone": {
                                        "kind": {
                                          "Variable": "a"
                                        },
                                        "span": {
                                          "start": 103,
                                          "end": 105
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 97,
                                      "end": 105
                                    }
                                  }
                                },
                                "span": {
                                  "start": 96,
                                  "end": 106
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 108,
                                  "end": 109
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 96,
                            "end": 109
                          }
                        }
                      },
                      "span": {
                        "start": 96,
                        "end": 109
                      }
                    }
                  ]
                },
                "span": {
                  "start": 95,
                  "end": 110
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 113,
                  "end": 115
                }
              }
            }
          },
          "span": {
            "start": 95,
            "end": 115
          }
        }
      },
      "span": {
        "start": 95,
        "end": 116
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 116
  }
}
