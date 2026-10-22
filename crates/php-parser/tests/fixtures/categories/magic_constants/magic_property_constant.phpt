===source===
<?php __PROPERTY__;
===ast <=8.3===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "__PROPERTY__"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 6,
                "end": 18
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MagicConst": "Property"
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
