===source===
<?php

const C = new Foo;

function a($x = new Foo) {
    static $y = new Foo;
}

#[Attr(new Foo)]
class Bar {
    const C = new Foo;
    public $prop = new Foo;
}
===errors===
New expressions are not supported in this context
New expressions are not supported in this context
===php_error===
PHP Fatal error:  New expressions are not supported in this context in Standard input code on line 11
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 13,
                "end": 14
              }
            },
            "value": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 21,
                          "end": 24
                        }
                      }
                    },
                    "span": {
                      "start": 21,
                      "end": 24
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 17,
                "end": 24
              }
            },
            "attributes": [],
            "span": {
              "start": 13,
              "end": 24
            }
          }
        ]
      },
      "span": {
        "start": 7,
        "end": 25
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 36,
              "end": 37
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 38,
                  "end": 40
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 47,
                            "end": 50
                          }
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 50
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 43,
                  "end": 50
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 38,
                "end": 50
              }
            }
          ],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "y",
                      "span": {
                        "start": 65,
                        "end": 67
                      }
                    },
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 74,
                                  "end": 77
                                }
                              }
                            },
                            "span": {
                              "start": 74,
                              "end": 77
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 77
                      }
                    },
                    "span": {
                      "start": 65,
                      "end": 77
                    }
                  }
                ]
              },
              "span": {
                "start": 58,
                "end": 78
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 27,
        "end": 80
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Bar",
            "span": {
              "start": 105,
              "end": 108
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 121,
                      "end": 122
                    }
                  },
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 129,
                                "end": 132
                              }
                            }
                          },
                          "span": {
                            "start": 129,
                            "end": 132
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 125,
                      "end": 132
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 115,
                "end": 133
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 145,
                      "end": 150
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 157,
                                "end": 160
                              }
                            }
                          },
                          "span": {
                            "start": 157,
                            "end": 160
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 153,
                      "end": 160
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 138,
                "end": 160
              }
            }
          ],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 84,
                  "end": 88
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 93,
                                  "end": 96
                                }
                              }
                            },
                            "span": {
                              "start": 93,
                              "end": 96
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 89,
                        "end": 96
                      }
                    }
                  },
                  "span": {
                    "start": 89,
                    "end": 96
                  }
                }
              ],
              "span": {
                "start": 84,
                "end": 97
              }
            }
          ]
        }
      },
      "span": {
        "start": 99,
        "end": 163
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163
  }
}
