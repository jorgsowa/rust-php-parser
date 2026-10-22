===source===
<?php
[$a]::foo();
array($a)::C;
[$a]::$b;
[$a]::class;
[...$a]::foo();
[A::B]::foo();
[$a]::{'foo'}();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 12,
                  "end": 15
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 25,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 27
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 28
                }
              },
              "member": {
                "kind": {
                  "Identifier": "C"
                },
                "span": {
                  "start": 30,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 19,
            "end": 31
          }
        }
      },
      "span": {
        "start": 19,
        "end": 32
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 34,
                            "end": 36
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 36
                      }
                    }
                  ]
                },
                "span": {
                  "start": 33,
                  "end": 37
                }
              },
              "member": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 39,
                  "end": 41
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 41
          }
        }
      },
      "span": {
        "start": 33,
        "end": 42
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 44,
                            "end": 46
                          }
                        }
                      },
                      "span": {
                        "start": 44,
                        "end": 46
                      }
                    }
                  ]
                },
                "span": {
                  "start": 43,
                  "end": 47
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 49,
                  "end": 54
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 54
          }
        }
      },
      "span": {
        "start": 43,
        "end": 55
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 60,
                            "end": 62
                          }
                        }
                      },
                      "span": {
                        "start": 57,
                        "end": 62
                      }
                    }
                  ]
                },
                "span": {
                  "start": 56,
                  "end": 63
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 65,
                  "end": 68
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 56,
            "end": 70
          }
        }
      },
      "span": {
        "start": 56,
        "end": 71
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "A"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 73,
                                      "end": 74
                                    }
                                  }
                                },
                                "span": {
                                  "start": 73,
                                  "end": 74
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "B"
                                },
                                "span": {
                                  "start": 76,
                                  "end": 77
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 73,
                            "end": 77
                          }
                        }
                      },
                      "span": {
                        "start": 73,
                        "end": 77
                      }
                    }
                  ]
                },
                "span": {
                  "start": 72,
                  "end": 78
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 80,
                  "end": 83
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 72,
            "end": 85
          }
        }
      },
      "span": {
        "start": 72,
        "end": 86
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCallDynamic": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 88,
                            "end": 90
                          }
                        }
                      },
                      "span": {
                        "start": 88,
                        "end": 90
                      }
                    }
                  ]
                },
                "span": {
                  "start": 87,
                  "end": 91
                }
              },
              "method": {
                "kind": {
                  "String": "foo"
                },
                "span": {
                  "start": 94,
                  "end": 99
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 87,
            "end": 102
          }
        }
      },
      "span": {
        "start": 87,
        "end": 103
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 103
  }
}
