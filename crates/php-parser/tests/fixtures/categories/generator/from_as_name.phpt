===source===
<?php
function from($a) { yield from from($a); yield FROM [1]; }
$g = from(1);
$c = From::class;
new From;
$x instanceof From;
function f(From $x): From {}
from\bar();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "from",
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 20,
                  "end": 22
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 20,
                "end": 22
              }
            }
          ],
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
                                    "from"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 37,
                                    "end": 41
                                  }
                                }
                              },
                              "span": {
                                "start": 37,
                                "end": 41
                              }
                            },
                            "args": [
                              {
                                "name": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 42,
                                      "end": 44
                                    }
                                  }
                                },
                                "span": {
                                  "start": 42,
                                  "end": 44
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 37,
                          "end": 45
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 45
                  }
                }
              },
              "span": {
                "start": 26,
                "end": 46
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
                          "Array": [
                            {
                              "key": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 59,
                                    "end": 60
                                  }
                                }
                              },
                              "span": {
                                "start": 59,
                                "end": 60
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 58,
                          "end": 61
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 61
                  }
                }
              },
              "span": {
                "start": 47,
                "end": 62
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
        "end": 64
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
                  "start": 65,
                  "end": 67
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "from"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 70,
                            "end": 74
                          }
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 74
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 75,
                              "end": 76
                            }
                          }
                        },
                        "span": {
                          "start": 75,
                          "end": 76
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 70,
                  "end": 77
                }
              }
            }
          },
          "span": {
            "start": 65,
            "end": 77
          }
        }
      },
      "span": {
        "start": 65,
        "end": 78
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
                  "start": 79,
                  "end": 81
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "From"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 84,
                            "end": 88
                          }
                        }
                      },
                      "span": {
                        "start": 84,
                        "end": 88
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 90,
                        "end": 95
                      }
                    }
                  }
                },
                "span": {
                  "start": 84,
                  "end": 95
                }
              }
            }
          },
          "span": {
            "start": 79,
            "end": 95
          }
        }
      },
      "span": {
        "start": 79,
        "end": 96
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "From"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 101,
                      "end": 105
                    }
                  }
                },
                "span": {
                  "start": 101,
                  "end": 105
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 97,
            "end": 105
          }
        }
      },
      "span": {
        "start": 97,
        "end": 106
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 107,
                  "end": 109
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Name": {
                    "parts": [
                      "From"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 121,
                      "end": 125
                    }
                  }
                },
                "span": {
                  "start": 121,
                  "end": 125
                }
              }
            }
          },
          "span": {
            "start": 107,
            "end": 125
          }
        }
      },
      "span": {
        "start": 107,
        "end": 126
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 136,
              "end": 137
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 143,
                  "end": 145
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "From"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 138,
                      "end": 142
                    }
                  }
                },
                "span": {
                  "start": 138,
                  "end": 142
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 138,
                "end": 145
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "From"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 148,
                  "end": 152
                }
              }
            },
            "span": {
              "start": 148,
              "end": 152
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 127,
        "end": 155
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
                      "from",
                      "bar"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 156,
                      "end": 164
                    }
                  }
                },
                "span": {
                  "start": 156,
                  "end": 164
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 156,
            "end": 166
          }
        }
      },
      "span": {
        "start": 156,
        "end": 167
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 167
  }
}
