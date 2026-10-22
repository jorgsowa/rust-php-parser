===source===
<?php

namespace {
    function f() {}
}

namespace Ns {
    function f() {}
}

namespace {
    use function Ns\f;
}

namespace Ns {
    use function f;
}

namespace {
    use function f;
}

namespace Ns {
    use function Ns\f;
}
===php_error <=8.3===
PHP Fatal error:  Cannot use function Ns\f as f because the name is already in use in Standard input code on line 12
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 32,
                        "end": 33
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 23,
                  "end": 38
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 7,
        "end": 40
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Ns"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 52,
              "end": 54
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 70,
                        "end": 71
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 61,
                  "end": 76
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 42,
        "end": 78
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "f"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 109,
                            "end": 113
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 109,
                          "end": 113
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 96,
                  "end": 114
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 80,
        "end": 116
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Ns"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 128,
              "end": 130
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 150,
                            "end": 151
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 150,
                          "end": 151
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 137,
                  "end": 152
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 118,
        "end": 154
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 185,
                            "end": 186
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 185,
                          "end": 186
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 172,
                  "end": 187
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 156,
        "end": 189
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Ns"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 201,
              "end": 203
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "f"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 223,
                            "end": 227
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 223,
                          "end": 227
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 210,
                  "end": 228
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 191,
        "end": 230
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 230
  }
}
