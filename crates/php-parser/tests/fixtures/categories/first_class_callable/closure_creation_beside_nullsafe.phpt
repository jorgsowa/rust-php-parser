===source===
<?php
$a?->b::c(...);
$a?->b[0](...);
f($a?->b)->c(...);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "StaticMethod": {
                  "class": {
                    "kind": {
                      "NullsafePropertyAccess": {
                        "object": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 6,
                            "end": 8
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "b"
                          },
                          "span": {
                            "start": 11,
                            "end": 12
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 6,
                      "end": 12
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "c"
                    },
                    "span": {
                      "start": 14,
                      "end": 15
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Function": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "NullsafePropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 22,
                                "end": 24
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "b"
                              },
                              "span": {
                                "start": 27,
                                "end": 28
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 22,
                          "end": 28
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 29,
                          "end": 30
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 31
                  }
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 36
          }
        }
      },
      "span": {
        "start": 22,
        "end": 37
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Method": {
                  "object": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 38,
                                "end": 39
                              }
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 39
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "NullsafePropertyAccess": {
                                  "object": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 40,
                                      "end": 42
                                    }
                                  },
                                  "property": {
                                    "kind": {
                                      "Identifier": "b"
                                    },
                                    "span": {
                                      "start": 45,
                                      "end": 46
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 40,
                                "end": 46
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 40,
                              "end": 46
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 38,
                      "end": 47
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "c"
                    },
                    "span": {
                      "start": 49,
                      "end": 50
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 38,
            "end": 55
          }
        }
      },
      "span": {
        "start": 38,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
