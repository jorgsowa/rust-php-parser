===source===
<?php
echo match($x){0}, match($x){$a + 1}[1];
===errors >=8.0===
expected '=>', found '}'
expected '=>', found '}'
Cannot dereference this expression
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}", expecting "=>" in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "match"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 11,
                              "end": 16
                            }
                          }
                        },
                        "span": {
                          "start": 11,
                          "end": 16
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Variable": "x"
                              },
                              "span": {
                                "start": 17,
                                "end": 19
                              }
                            }
                          },
                          "span": {
                            "start": 17,
                            "end": 19
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 20
                  }
                },
                "index": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 21,
                    "end": 22
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 23
            }
          },
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "match"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 25,
                                    "end": 30
                                  }
                                }
                              },
                              "span": {
                                "start": 25,
                                "end": 30
                              }
                            },
                            "args": [
                              {
                                "name": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "x"
                                    },
                                    "span": {
                                      "start": 31,
                                      "end": 33
                                    }
                                  }
                                },
                                "span": {
                                  "start": 31,
                                  "end": 33
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 34
                        }
                      },
                      "index": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 35,
                                "end": 37
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 40,
                                "end": 41
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 41
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 42
                  }
                },
                "index": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 43,
                    "end": 44
                  }
                }
              }
            },
            "span": {
              "start": 25,
              "end": 45
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Match": {
                "subject": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 17,
                    "end": 19
                  }
                },
                "arms": [
                  {
                    "conditions": [
                      {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 21,
                          "end": 22
                        }
                      }
                    ],
                    "body": {
                      "kind": "Error",
                      "span": {
                        "start": 22,
                        "end": 22
                      }
                    },
                    "span": {
                      "start": 21,
                      "end": 22
                    }
                  }
                ]
              }
            },
            "span": {
              "start": 11,
              "end": 23
            }
          },
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Match": {
                      "subject": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 31,
                          "end": 33
                        }
                      },
                      "arms": [
                        {
                          "conditions": [
                            {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 35,
                                      "end": 37
                                    }
                                  },
                                  "op": "Add",
                                  "right": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 40,
                                      "end": 41
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 35,
                                "end": 41
                              }
                            }
                          ],
                          "body": {
                            "kind": "Error",
                            "span": {
                              "start": 41,
                              "end": 41
                            }
                          },
                          "span": {
                            "start": 35,
                            "end": 41
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 42
                  }
                },
                "index": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 43,
                    "end": 44
                  }
                }
              }
            },
            "span": {
              "start": 25,
              "end": 45
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
