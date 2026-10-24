===source===
<?php
namespace A;
?>
x<?php
namespace B;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 19,
        "end": 22
      }
    },
    {
      "kind": {
        "InlineHtml": "x"
      },
      "span": {
        "start": 22,
        "end": 23
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 39,
              "end": 40
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 29,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
