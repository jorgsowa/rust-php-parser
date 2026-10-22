===source===
<?php

namespace {
    class C {}
}

namespace Ns {
    class C {}
}

namespace {
    use Ns\C;
}

namespace Ns {
    use C;
}

namespace {
    use C;
}

namespace Ns {
    use Ns\C;
}
===php_error <=8.3===
PHP Fatal error:  Cannot use Ns\C as C because the name is already in use in Standard input code on line 12
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
                  "Class": {
                    "name": {
                      "name": "C",
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": null,
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 23,
                  "end": 33
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 7,
        "end": 35
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
              "start": 47,
              "end": 49
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "C",
                      "span": {
                        "start": 62,
                        "end": 63
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": null,
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 56,
                  "end": 66
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 37,
        "end": 68
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
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "C"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 90,
                            "end": 94
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 90,
                          "end": 94
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 86,
                  "end": 95
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 70,
        "end": 97
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
              "start": 109,
              "end": 111
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 122,
                            "end": 123
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 122,
                          "end": 123
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 118,
                  "end": 124
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 99,
        "end": 126
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
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 148,
                            "end": 149
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 148,
                          "end": 149
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 144,
                  "end": 150
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 128,
        "end": 152
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
              "start": 164,
              "end": 166
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "C"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 177,
                            "end": 181
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 177,
                          "end": 181
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 173,
                  "end": 182
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 154,
        "end": 184
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 184
  }
}
