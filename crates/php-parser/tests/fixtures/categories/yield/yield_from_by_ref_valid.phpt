===source===
<?php
function &g() { yield 1; }
function g2() { yield from f(); }
function &g3() {
    function h() { yield from f(); }
    $c = function () { yield from f(); };
    $d = fn() => yield from f();
    yield 1;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 16,
              "end": 17
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
                          "Int": 1
                        },
                        "span": {
                          "start": 28,
                          "end": 29
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 29
                  }
                }
              },
              "span": {
                "start": 22,
                "end": 30
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g2",
            "span": {
              "start": 42,
              "end": 44
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
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "f"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 60,
                                    "end": 61
                                  }
                                }
                              },
                              "span": {
                                "start": 60,
                                "end": 61
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 60,
                          "end": 63
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 49,
                    "end": 63
                  }
                }
              },
              "span": {
                "start": 49,
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
        "start": 33,
        "end": 66
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g3",
            "span": {
              "start": 77,
              "end": 79
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Function": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 97,
                      "end": 98
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
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "f"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 114,
                                            "end": 115
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 114,
                                        "end": 115
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 114,
                                  "end": 117
                                }
                              },
                              "is_from": true
                            }
                          },
                          "span": {
                            "start": 103,
                            "end": 117
                          }
                        }
                      },
                      "span": {
                        "start": 103,
                        "end": 118
                      }
                    }
                  ],
                  "return_type": null,
                  "by_ref": false,
                  "attributes": []
                }
              },
              "span": {
                "start": 88,
                "end": 120
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 125,
                          "end": 127
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
                                      "Yield": {
                                        "key": null,
                                        "value": {
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
                                                      "start": 155,
                                                      "end": 156
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 155,
                                                  "end": 156
                                                }
                                              },
                                              "args": []
                                            }
                                          },
                                          "span": {
                                            "start": 155,
                                            "end": 158
                                          }
                                        },
                                        "is_from": true
                                      }
                                    },
                                    "span": {
                                      "start": 144,
                                      "end": 158
                                    }
                                  }
                                },
                                "span": {
                                  "start": 144,
                                  "end": 159
                                }
                              }
                            ],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 130,
                          "end": 161
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 125,
                    "end": 161
                  }
                }
              },
              "span": {
                "start": 125,
                "end": 162
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "d"
                        },
                        "span": {
                          "start": 167,
                          "end": 169
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
                                "Yield": {
                                  "key": null,
                                  "value": {
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
                                                "start": 191,
                                                "end": 192
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 191,
                                            "end": 192
                                          }
                                        },
                                        "args": []
                                      }
                                    },
                                    "span": {
                                      "start": 191,
                                      "end": 194
                                    }
                                  },
                                  "is_from": true
                                }
                              },
                              "span": {
                                "start": 180,
                                "end": 194
                              }
                            },
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 172,
                          "end": 194
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 167,
                    "end": 194
                  }
                }
              },
              "span": {
                "start": 167,
                "end": 195
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
                          "Int": 1
                        },
                        "span": {
                          "start": 206,
                          "end": 207
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 200,
                    "end": 207
                  }
                }
              },
              "span": {
                "start": 200,
                "end": 208
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 67,
        "end": 210
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 210
  }
}
