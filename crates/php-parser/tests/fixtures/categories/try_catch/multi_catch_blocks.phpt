===source===
<?php try { foo(); } catch (A $a) { } catch (B $b) { } catch (C $c) { }
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
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
                    "start": 12,
                    "end": 17
                  }
                }
              },
              "span": {
                "start": 12,
                "end": 18
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "A"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 28,
                    "end": 29
                  }
                }
              ],
              "var": "a",
              "body": [],
              "span": {
                "start": 27,
                "end": 37
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "B"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 45,
                    "end": 46
                  }
                }
              ],
              "var": "b",
              "body": [],
              "span": {
                "start": 44,
                "end": 54
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "C"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 62,
                    "end": 63
                  }
                }
              ],
              "var": "c",
              "body": [],
              "span": {
                "start": 61,
                "end": 71
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
