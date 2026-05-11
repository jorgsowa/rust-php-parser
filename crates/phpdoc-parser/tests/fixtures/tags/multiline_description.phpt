===input===
/**
 * Short summary.
 *
 * First paragraph of description.
 * Second line of first paragraph.
 *
 * @param int $x The value
 */
===output===
{
  "summary": {
    "segments": [
      {
        "Text": "Short summary."
      }
    ],
    "span": {
      "start": 7,
      "end": 21
    }
  },
  "description": {
    "segments": [
      {
        "Text": "First paragraph of description.\nSecond line of first paragraph."
      }
    ],
    "span": {
      "start": 28,
      "end": 94
    }
  },
  "tags": [
    {
      "name": "param",
      "body": {
        "segments": [
          {
            "Text": "int $x The value"
          }
        ],
        "span": {
          "start": 108,
          "end": 124
        }
      },
      "span": {
        "start": 101,
        "end": 126
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 128
  }
}
