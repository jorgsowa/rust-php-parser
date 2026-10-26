===source===
<?php
function f($x) {
    f($a[]);
    $g = function () {
        f($a[]);
    };
    $h = fn() => F($a[]);
    function inner() {
        \f($a[]);
    }
}
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
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 19
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
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
                              "start": 27,
                              "end": 28
                            }
                          }
                        },
                        "span": {
                          "start": 27,
                          "end": 28
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "ArrayAccess": {
                                  "array": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 29,
                                      "end": 31
                                    }
                                  },
                                  "index": null
                                }
                              },
                              "span": {
                                "start": 29,
                                "end": 33
                              }
                            }
                          },
                          "span": {
                            "start": 29,
                            "end": 33
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 34
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 35
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "g"
                        },
                        "span": {
                          "start": 40,
                          "end": 42
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Closure": {
                            "is_static": false,
                            "by_ref": false,
                            "params": [],
                            "use_vars": [],
                            "return_type": null,
                            "body": [
                              {
                                "kind": {
                                  "Expression": {
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
                                                "start": 67,
                                                "end": 68
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 67,
                                            "end": 68
                                          }
                                        },
                                        "args": [
                                          {
                                            "name": null,
                                            "kind": {
                                              "Value": {
                                                "kind": {
                                                  "ArrayAccess": {
                                                    "array": {
                                                      "kind": {
                                                        "Variable": "a"
                                                      },
                                                      "span": {
                                                        "start": 69,
                                                        "end": 71
                                                      }
                                                    },
                                                    "index": null
                                                  }
                                                },
                                                "span": {
                                                  "start": 69,
                                                  "end": 73
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 69,
                                              "end": 73
                                            }
                                          }
                                        ]
                                      }
                                    },
                                    "span": {
                                      "start": 67,
                                      "end": 74
                                    }
                                  }
                                },
                                "span": {
                                  "start": 67,
                                  "end": 75
                                }
                              }
                            ],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 45,
                          "end": 81
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 40,
                    "end": 81
                  }
                }
              },
              "span": {
                "start": 40,
                "end": 82
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "h"
                        },
                        "span": {
                          "start": 87,
                          "end": 89
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "ArrowFunction": {
                            "is_static": false,
                            "by_ref": false,
                            "params": [],
                            "return_type": null,
                            "body": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "F"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 100,
                                          "end": 101
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 100,
                                      "end": 101
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "ArrayAccess": {
                                              "array": {
                                                "kind": {
                                                  "Variable": "a"
                                                },
                                                "span": {
                                                  "start": 102,
                                                  "end": 104
                                                }
                                              },
                                              "index": null
                                            }
                                          },
                                          "span": {
                                            "start": 102,
                                            "end": 106
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 102,
                                        "end": 106
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 100,
                                "end": 107
                              }
                            },
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 92,
                          "end": 107
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 87,
                    "end": 107
                  }
                }
              },
              "span": {
                "start": 87,
                "end": 108
              }
            },
            {
              "kind": {
                "Function": {
                  "name": {
                    "name": "inner",
                    "span": {
                      "start": 122,
                      "end": 127
                    }
                  },
                  "params": [],
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "f"
                                    ],
                                    "kind": "FullyQualified",
                                    "span": {
                                      "start": 140,
                                      "end": 142
                                    }
                                  }
                                },
                                "span": {
                                  "start": 140,
                                  "end": 142
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "ArrayAccess": {
                                          "array": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 143,
                                              "end": 145
                                            }
                                          },
                                          "index": null
                                        }
                                      },
                                      "span": {
                                        "start": 143,
                                        "end": 147
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 143,
                                    "end": 147
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 140,
                            "end": 148
                          }
                        }
                      },
                      "span": {
                        "start": 140,
                        "end": 149
                      }
                    }
                  ],
                  "return_type": null,
                  "by_ref": false,
                  "attributes": []
                }
              },
              "span": {
                "start": 113,
                "end": 155
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
        "end": 157
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 157
  }
}
